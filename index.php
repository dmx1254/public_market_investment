<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bidding Platform</title>
  <link rel="icon" href="images/logodesk.png" type="image/png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

  <link rel="stylesheet" href="css/styles.css" />

</head>

<body>
  <?php include "navbar.php"; ?>
  <main class="content">
    <?php include "sidebar.php"; ?>
    <div class="content_container">
      <div id="loadingRow" style="display: none; display: block; margin: 0px auto; text-align: center;">
        <?php include "loader.php" ?>
      </div>
      <div class="container-market" id="title">
        <p class="subtitle">
          La place des
          <span class="title"> Marchés Publics </span>
        </p>
      </div>
      <div class="table-container" id="table-display">
        <table class="custom-table">
          <thead>
            <tr>
              <th scope="col" class="header-cell">Categorie</th>
              <th scope="col" class="header-cell">Reference</th>
              <th scope="col" class="header-cell">Titre</th>
              <th scope="col" class="header-cell">Date Publication</th>
              <th scope="col" class="header-cell">Date d'Expiration</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="data-cell" colspan="4"></td>
              <td class="data-cell" style="border-left: none;">
                <button class="custom-button" id="loadMoreButton">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="menu-icon">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7">
                    </path>
                  </svg>
                  voir plus
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="market">
        <span class="market-title">
          Les <h2>Marchés au Maroc</h2>
        </span>
        <div class="market-desc">
          Chaque année, le gouvernement du maroc dépense des milliards de dollars, dans la commande publique de biens
          et services suivant la procedure de passation des marchés (Plans de passations, Avis généraux, Appels d'offres
          (AAO), Avis d'attribution provisoire de marchés ou Avis d'attribution definitive de marchés, Ententes
          directes, Arrêtés de résiliation, Contentieux, Résolutions, Saisines DCMP). Nous aidons les dirigeants du
          secteur public à <span>moderniser</span> les applications et les pratiques de travail existantes, à
          <span>accélérer</span> la prestation
          de services numériques, à prendre des décisions plus intelligentes basées sur des données réelles et à
          <span>améliorer</span> les compétences technologiques au sein des équipes.

          Nous avons une expérience éprouvée dans l'aide aux organisations du secteur public pour <span>fournir</span>
          des services
          numériques centrés sur l'utilisateur et à prendre de meilleures décisions grâce aux données et à
          l'automatisation.
          <span>Activation des compétences technologiques</span>, nous aidons les organisations à
          <span>développer</span> en leur sein des
          compétences technologiques modernes nécessaires à l'ère d'Internet, leur permettant d'<span>évoluer</span>
          continuellement
          et de <span>répondre</span> à la demande changeante.
        </div>
      </div>
    </div>
  </main>
  <?php include 'mobile-sidebar.php' ?>
  <?php include 'footer.php' ?>
  <script>
    const converDate = (date) => {
      let dateToConvert = new Date(date).toLocaleDateString("fr-FR", {
        year: "numeric",
        month: "numeric",
        day: "numeric",
      });
      return dateToConvert?.split("/").join("-");
    }

    document.addEventListener("DOMContentLoaded", function () {
      let offset = 0; // Initialiser l'offset à 0

      // Fonction pour récupérer les données
      function getData(limit, append) {
        if (append) {
          document.getElementById('loadingRow').style.display = 'none';
        } else {
          document.getElementById('loadingRow').style.display = 'flex';
          document.getElementById('title').style.display = 'none';
          document.getElementById('table-display').style.display = 'none';
        }

        // Envoie d'une requête AJAX à get_home_data.php avec un paramètre d'offset
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "get_home_data.php?offset=" + offset + "&limit=" + limit, true);
        xhr.onreadystatechange = function () {
          if (xhr.readyState == 4 && xhr.status == 200) {
            // Une fois la requête terminée avec succès, traiter la réponse
            let response = JSON.parse(xhr.responseText);
            document.getElementById('loadingRow').style.display = 'none';
            document.getElementById('title').style.display = 'flex';
            document.getElementById('table-display').style.display = 'flex';
            // console.log(xhr.responseText)

            // Mettre à jour la table avec les nouvelles données
            let tbody = document.querySelector("tbody");

            // Si ce n'est pas un ajout, on remplace le contenu
            if (!append) tbody.innerHTML = "";

            response.forEach(function (row) {
              let tr = document.createElement("tr");
              tr.classList.add("cursor-pointer", "hover:bg-gray-100");

              tr.innerHTML = "<td class='data-cell'><i class='fas fa-folder'></i> " + row.category + "</td>" +
                "<td class='data-cell'>" + row.numero_reference + "</td>" +
                "<td class='data-cell' style='display: flex; align-items: center; gap: 5px'>" +
                "<i class='far fa-file-alt'></i><span class='table_title'>" + row.titre + "</span></td>" +
                "<td class='data-cell'>" + converDate(row.date_publication) + "</td>" +
                "<td class='data-cell'>" + row.date_expiration + "</td>";
              tr.addEventListener("click", function () {
                window.location.href = 'apply.php?numero_annonce=' + row.id;
              });

              tbody.appendChild(tr);
            });

            // Incrémenter l'offset de 5 pour les prochaines données
            offset += limit;

            // Réafficher le bouton "voir plus" en bas des nouvelles lignes
            tbody.appendChild(loadMoreButton.closest('tr'));
          }
        };
        xhr.send();
      }

      // Écouter le clic sur le bouton "voir plus" et appeler getData() à nouveau
      let loadMoreButton = document.getElementById("loadMoreButton");
      loadMoreButton.addEventListener("click", function () {
        getData(5, true); // Récupérer 5 lignes supplémentaires et ajouter au tableau
      });

      // Charger initialement 10 annonces
      getData(10, false);
    });
  </script>
</body>

</html>