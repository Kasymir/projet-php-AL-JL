<?php


class Race extends Controller
{

    function __construct()
    {
        parent::__construct();
    }


    function index()
    {
        $this->loadModel('Joueur_raceSQL');
        $model = new Joueur_raceSQL();

        $this->view->race = $model->findAll()->execute();

        $this->view->render('race/index');
    }

    function ajouter()
    {

        if (isset($_POST['add'])) {

            if (!empty($_POST['nom'])) {
                $this->loadModel('Joueur_raceSQL');

                $model_raceSQL = new Joueur_raceSQL();

                if ($model_raceSQL->findWithCondition('id_pouvoir = :idp', array(':idp' => $_POST['id_pouvoir']))->rowCount() == 0) {


                    $this->loadModel('Joueur_race');
                    $table = new Joueur_race($_POST['nom'], $_POST['id_pouvoir']);
                    $table->save();

                    SESSION::set('feedback_positive', RACE_CREATED);
                    header('Location: ' . URL . 'race/gestionRace');
                } else {
                    SESSION::set('feedback_negative', RACE_ALREADY_USED);
                    header('Location:' . URL . "race/gestionRace");
                }

            } else {
                SESSION::set('feedback_negative', EMPTY_FIELD);
                header('Location: ' . URL . 'race/gestionRace');
            }
        }
        else {
            header('Location: ' . URL . 'race/gestionRace');
        }

    }

    function gestionRace()
    {

        Auth::handleLogin();
        $this->loadModel('Joueur_pouvoirSQL');
        $model_pouvoir = new Joueur_pouvoirSQL();

        $this->loadModel('Joueur_raceSQL');
        $model = new Joueur_raceSQL();

        $this->view->race = $model->findAll()->execute();
        $this->view->pouvoirs = $model_pouvoir->findAll()->execute();

        $this->view->render('race/manage');
    }

    function update($id)
    {

        Auth::handleLogin();
        if (isset($_POST['modifier'])) {
            if (!empty($_POST['nom']) && !empty($_POST['id_pouvoir'])) {

                $this->loadModel('Joueur_race');
                $this->loadModel('Joueur_raceSQL');

                $model_raceSQL = new Joueur_raceSQL();

                if ($model_raceSQL->findWithCondition('id_pouvoir = :idp and id != :id', array(':idp' => $_POST['id_pouvoir'], ':id' => $id))->rowCount() == 0) {
                    $model_race = new Joueur_race($_POST['nom'], $_POST['id_pouvoir']);
                    $model_race->setId($id);
                    $model_race->save();
                    SESSION::set('feedback_positive', RACE_UPDATE);
                    header('Location:' . URL . "race/gestionRace");
                } else {
                    SESSION::set('feedback_negative', RACE_ALREADY_USED);
                    header('Location:' . URL . "race/gestionRace");
                }

            } else {
                SESSION::set('feedback_negative', EMPTY_FIELD);
                header('Location: ' . URL . 'race/gestionRace');
            }
        } else {
            header('Location: ' . URL . 'race/gestionRace');
        }
    }

    function delete($id)
    {
        Auth::handleLogin();

        $this->loadModel('JoueurSQL');
        $model_joueur = new JoueurSQL();

        if($model_joueur->findWithCondition('race = :idr',array(':idr'=>$id))->rowCount()==0){
            $this->loadModel('Joueur_race');
            $model = new Joueur_race();
            $model->setId($id);
            $model->delete();
            SESSION::set('feedback_positive',RACE_DELETE);
            header('Location:' . URL . "race/gestionRace");
        }else{
            SESSION::set('feedback_negative',RACE_USED);
            header('Location:' . URL . "race/gestionRace");
        }

    }
}
