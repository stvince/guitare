<?php


namespace Apps\FormContact\Ctrl;


use Boom\Ctrl\Controller;

class FormContact extends Controller
{
    function __construct($appname, $request, $response, array $params, $name)
    {
        $this->hasModel = false;
        parent::__construct($appname, $request, $response, $params, $name);
    }

    function action_main($params = null)
    {
        //parent::action_main($params); // TODO: Change the autogenerated stub
        return $this->view('form');
    }

    function action_form($params = null)
    {
        //parent::action_main($params); // TODO: Change the autogenerated stub
        //return $this->view('form');
        dd('pouet');
        $sujet = 'Sujet de l\'email';
        $message = "Bonjour,<br />
<strong>Ceci est un message html envoyé grâce à  php.</strong><br />
merci :)";
        $destinataire = 'destinataire@domaine.com';
        $headers = "From: \"expediteur moi\"<moi@domaine.com>\n";
        $headers .= "Reply-To: moi@domaine.com\n";
        $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
        if(mail($destinataire,$sujet,$message,$headers))
        {
            echo "L'email a bien été envoyé.";
        }
    }

}