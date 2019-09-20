<?php

include 'vendor/autoload.php';
use Symfony\Component\Dotenv\Dotenv;

use App\Entity\User;
use App\Model\UserModel;
use App\Service\Avatar\Avatar\SvgAvatarFactory;
use App\Service\Avatar\Helpers\FilesystemHelper;
use Core\DB\Database;

// Si le formulaire a été soumis, on traite les données
if(!empty($_POST)) {

    // Création d'un avatar
    $svg = SvgAvatarFactory::getAvatar(3,7);

    // Création d'un nom de fichier unique et aléatoire
    $filename = sha1(uniqid(rand(), true)) .'.svg';

    // Enregistrement du fichier SVG
    $fs = new FilesystemHelper();
    $fs->write('uploads/avatars/'. $filename, $svg);

    $dotenv = new Dotenv();
    $dotenv->load(__DIR__.'/.env');

    $config = explode("##",$_ENV['DATABASE']);

    $pdo = new PDO('mysql:host='.$config[0].';dbname='.$config[1].'',$config[2],$config[3],[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC]);
    $pdo ->exec('SET NAMES UTF8');
    $db=new Database($pdo);
    $userModel=new UserModel($db);



    try {

        // Création d'un objet User à partir des champs du formulaire


        $user = new User($_POST);

        // On remplit le champ avatar
        $user->setAvatar($filename);

        // Insertion des données du formulaire dans la base de données
        $userModel->insert($user);
    }
    catch(Exception $e) {
        dump($e->getMessage());
        die;
    }

    dump('Insertion user OK, vérifier dans la BDD.');
    die;
}

// Affichage
include 'template/create_user.phtml';
