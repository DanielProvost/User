<?php

namespace App\Model;

use App\Entity\User;
use Core\DB\AbstractModel;

/**
 * Class UserModel
 * S'occupe de tout ce qui touche la table user dans la base de données
 */
class UserModel extends AbstractModel {

    /**
     * Insert a User into the database
     * @param string $firstname
     * @param string $lastname
     * @param string $email
     * @param string $password
     */
    public function insert(User $user)
    {
        // @todo Envoyer email de vérification avec token

        // On cherche un utilisateur avec l'email
        $userBdd = $this->getUserByEmail($user->getEmail());
        if($userBdd){

            // Si on trouve un résultat, il existe déjà un compte avec cet email, on ne peut pas en recréer un
            throw new \Exception('Cet email existe déjà dans la base de données.');
        }

        // Hashage du mot de passe
        $passwordHash = password_hash($user->getPassword(), PASSWORD_DEFAULT);

        // Requête SQL d'insertion
        $sql = 'INSERT INTO user 
                (firstname, lastname, email, password, avatar, createdAt)
                VALUES (?, ?, ?, ?, ?, NOW())';

        // Exécution de la requête
        $this->db->executeQuery($sql, [
                $user->getFirstname(),
                $user->getLastname(),
                $user->getEmail(),
                $passwordHash,
                $user->getAvatar()
            ]
        );
    }


    /**
     * @param string $email
     * @return mixed
     */
    public function getUserByEmail(string $email)
    {
        $sql = 'SELECT *
                FROM user
                WHERE Email = ?';
        $data = $this->db->queryOne($sql, [$email]);

        if($data){
            return new User($data);
        }

        return null;
    }

}