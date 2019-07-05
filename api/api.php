<?php include("0-config/config-genos.php");

if (isset($_GET["cas"])) {
    $cas = $_GET["cas"];

    switch  ($cas) {

        // --- CLASSE ---

                // GETCLASSE START
                case 'getclasse':
                $classe = new classe;
                $req = "select classe.id as id, libelle, numero, classe.suppr, count(eleve.id) as nb_eleve 
                from classe left join eleve on classe.id = eleve.id_classe 
                where classe.suppr = 0 
                group by classe.id 
                order by numero";
                $champs = array("id", "libelle", "numero", "nb_eleve");
                $res = $classe->StructList($req,$champs,"json");
                echo $res;
                break;
                // GETCLASSE END

                // EDITCLASSE START
                case 'editclasse':
                $classe = new classe;
                $item = json_decode(file_get_contents('php://input'), true);
                $classe->id = $_GET['idclasse'];
                $classe->Load();
                $classe->numero = $item['numero'];
                $classe->libelle = $item['libelle'];
                $classe->Update();
                echo $classe->libelle; 
                break;
                // EDITCLASSE END

                // ADDCLASSE START
                case 'addclasse':
                $classe = new classe;
                $item = json_decode(file_get_contents('php://input'), true);
                if ($item['numero'] === 0 ) {
                    echo -1;
                    return;
                }
                $classe->numero = $item['numero'];
                $classe->libelle = $item['libelle'];
                $classe->Add();
                echo $classe->libelle;
                break;
                // ADDCLASSE END

                //DELETECLASSE START
                case 'deleteclasse':
                $classe = new classe;
                $classe->id = $_GET['idclasse'];
                $classe->Load();
                $req = "SELECT count(*) as countEleve FROM eleve WHERE eleve.id_classe = $classe->id and eleve.suppr = 0";
                $champs = array("countEleve");
                $res = $classe->StructList($req,$champs,"array");
                if ($res[0]['countEleve'] !== '0') {
                    echo 0;
                    return ;
                }
                $classe->Delete();
                echo 1;
                break;
                //DELETECLASSE END

        // --- ELEVE ---

                //GET ELEVES
                case 'geteleve':
                $eleve = new eleve;
                $req = "SELECT eleve.id, nom, prenom, date_naissance, classe.id as classeId, classe.libelle as classeLibelle, classe.numero as classeNumero 
                FROM `eleve` join classe on eleve.id_classe = classe.id 
                where eleve.suppr = 0";
                $champs = array("id", "nom", "prenom", "date_naissance", "classeId", "classeLibelle", "classeNumero");
                $res = $eleve->StructList($req,$champs,"json");
                echo $res;
                break;

                //ADD ELEVE
                case 'addeleve':
                $eleve = new eleve;
                $item = json_decode(file_get_contents('php://input'), true);
                $eleve->nom = $item['nom'];
                $eleve->prenom = $item['prenom'];
                $eleve->date_naissance = $item['date_naissance'];
                $eleve->id_classe = $item['classe'];
                $eleve->Add();
                echo 'ok';
                break;

                // EDIT ELEVE
                case 'editeleve':
                $eleve = new eleve;
                $item = json_decode(file_get_contents('php://input'), true);
                $eleve->id = $_GET['id'];
                $eleve->Load();
                $eleve->nom = $item['nom'];
                $eleve->prenom = $item['prenom'];
                $eleve->date_naissance = $item['date_naissance'];
                $eleve->id_classe = $item['classe'];
                $eleve->Update();
                echo "ok";
                break;

                // DELETE ELEVE 
                case 'deleteeleve':
                $eleve = new eleve;
                $eleve->id = $_GET['ideleve'];
                $eleve->Delete();
                echo $eleve->nom;
                break;

        // MATIERE
                //GET MATIERE_ELEVES
                case 'getmatiereeleve':
                $matiere = new matiere;
                $req = "select ma.intitule as intitule, ma.id as id
                from matiere ma join classe_matiere cm on ma.id = cm.id_matiere join classe cl on cm.id_classe = cl.id join eleve e on cl.id = e.id_classe 
                where e.suppr = 0 and cl.suppr = 0 and ma.suppr = 0 and cm.suppr = 0 and e.id = :id_eleve";
                $bind = array ( "id_eleve" => $_GET['ideleve']);
                $fields = array ( "id", "intitule" );
                $res = $matiere->StructList($req, $fields, $bind, "json");
                echo $res;
                break;
                //
                // GET MATIERE START
                case 'getMatiere':
                $matiere = new matiere;
                $req = "SELECT * FROM `matiere` WHERE matiere.suppr = 0";
                $champs = array("id", "intitule");
                $res = $matiere->StructList($req,$champs,"json");
                echo $res;
                break;
                // GET MATIERE END

                // ADD MATIERE START
                case 'addmatiere':
                $matiere = new matiere;
                $item = json_decode(file_get_contents('php://input'), true);
                $matiere->intitule = $item['intitule'];
                $matiere->Add();
                echo $matiere->intitule;
                break;
                // ADD MATIERE END

                // MODIF MATIERE START
                case 'editmatiere':
                $matiere = new matiere;
                $item = json_decode(file_get_contents('php://input'), true);
                $matiere->id = $_GET['idmatiere'];
                $matiere->Load();
                $matiere->intitule = $item['intitule'];
                $matiere->Update();
                echo $matiere->intitule;              
                break;
                // MODIF MATIERE END

                // DELETE MATIERE START
                case 'deletematiere':
                $matiere = new matiere;
                $matiere->id = $_GET['idmatiere'];
                $matiere->Delete();
                echo $matiere->intitule;
                break;
                // DELETE MATIERE END

        // CLASSE_MATIERE

                // GET CLASSE_MATIERE (ID_CLASSE) START
                case 'getclassematiere':
                $classe_matiere = new classe_matiere;
                $classeId = $_GET['idclasse'];
                $req = "SELECT classe_matiere.id, classe.id as classeId, classe.libelle as classeLibelle, matiere.id as matiereId, matiere.intitule as matiereIntitule 
                from classe join classe_matiere on classe.id = classe_matiere.id_classe join matiere on classe_matiere.id_matiere = matiere.id 
                where classe_matiere.suppr = 0 and classe.suppr = 0 and matiere.suppr = 0 and classe_matiere.suppr = 0 and classe.id = $classeId";
                $champs = array("id", "classeId", "classeLibelle", "matiereId", "matiereIntitule");
                $res = $classe_matiere->StructList($req,$champs,"json");
                echo $res;
                break;
                // GET CLASSE_MATIERE (ID_CLASSE) END

                // EDIT GET CLASSE_MATIERE START
                case 'editselectedmatiere';
                $classe_matiere = new classe_matiere;
                $classe_matiere->id_classe = $_GET['idclasse'];
                $classe_matiere->id_matiere = $_GET['idmatiere'];
                $req = "SELECT * FROM `classe_matiere` WHERE id_classe = :id_classe and id_matiere = :id_matiere and classe_matiere.suppr = 1";
                $bind = array ( "id_classe" => $_GET['idclasse'], "id_matiere" =>  $_GET['idmatiere']);
                $fields = array ( "id" );
                $res = $classe_matiere->StructList($req,$fields, $bind, "array");
                if (empty($res)) {
                    $classe_matiere->Add();
                } else {
                    $classe_matiere->id = $res[0]['id'];
                    $classe_matiere->Load();
                    $classe_matiere->suppr = 0;
                    $classe_matiere->Update();
                    echo 'ok';
                }
                break;
                //

                //
                case 'deleteselectedmatiere';
                $classe_matiere = new classe_matiere;
                $classe_matiere->id = $_GET['id'];
                $classe_matiere->Delete();
                echo $classe_matiere->id;
                break;
        // NOTES
                
                //GET NOTES ELEVE MATIERE
                case 'getnotesmatiereeleve':
                $note = new note;
                $req = "SELECT DISTINCT(n.id) as id, n.valeur as valeur, description, coefficient, intitule
                from note n inner join matiere m on n.id_matiere = m.id inner join classe_matiere cm on m.id = cm.id_matiere
                where n.id_eleve = :id_eleve and n.id_matiere = :id_matiere and m.suppr = 0 and  n.suppr = 0 and cm.suppr = 0";
                $bind = array ( "id_eleve" => $_GET['ideleve'], "id_matiere" => $_GET["idmatiere"]);
                $fields = array ( "id", "valeur", "description", "coefficient", "intitule" );
                $res = $note->StructList($req, $fields, $bind, "json");
                echo $res;
                break;

                // GET ALL NOTES
                case 'getallnotesmatiereeleve':
                $note = new note;
                $req = "SELECT DISTINCT(n.id) as id, n.valeur as valeur, description, coefficient, intitule 
                from note n inner join matiere m on n.id_matiere = m.id inner join classe_matiere cm on m.id = cm.id_matiere
                where n.id_eleve = :id_eleve and m.suppr = 0 and  n.suppr = 0 and cm.suppr = 0";
                $bind = array ( "id_eleve" => $_GET['ideleve']);
                $fields = array ( "id", "valeur", "description", "coefficient", "intitule" );
                $res = $note->StructList($req, $fields, $bind, "json");
                echo $res;
                break;

                //ADD NOTE
                case 'addNote':
                $note = new note;
                $item = json_decode(file_get_contents('php://input'), true);
                $note->valeur = $item['valeur'];
                $note->coefficient = $item['coefficient'];
                $note->description = $item['description'];
                $note->id_eleve = $item['id_eleve'];
                $note->id_matiere = $item['matiere'];
                $note->Add();
                echo 'ok';
                break;

                //EDIT NOTE
                case 'editnote':
                $note = new note;
                $item = json_decode(file_get_contents('php://input'), true);
                $note->id = $item['id'];
                $note->Load();
                $note->valeur = $item['valeur'];
                $note->coefficient = $item['coefficient'];
                $note->description = $item['description'];
                $note->Update();
                echo $note->id;
                break;

                //DELETE NOTE
                case 'deletenote':
                $note = new note;
                $item = json_decode(file_get_contents('php://input'), true);
                $note->id = $item['id'];
                $note->Delete();
                echo 'Suppr ok';
                break;

    }

}
