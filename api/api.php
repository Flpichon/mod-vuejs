<?php include("0-config/config-genos.php");

if (isset($_GET["cas"])) {
    $cas = $_GET["cas"];

    switch  ($cas) {
        // GETCLASSE
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

        // EDITCLASSE
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

        // ADDCLASSE
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

        //DELETECLASSE
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
        break;
    }

}
