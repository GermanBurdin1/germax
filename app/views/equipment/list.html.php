<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Location d'équipement</title>
 
</head>
<body>
  <?php include '../shared/header.php'; ?>

  <div class="container-fluid">
    <div class="row">
      <div id="equipment-list" class="col-md-12">
        <!-- Les cartes d'équipement seront ici -->
      </div>
      <div class="col-md-12 text-center">
        <button id="load-more" class="btn btn-primary mt-3">Charger plus</button>
      </div>
    </div>
  </div>

  <?php include '../shared/footer.php'; ?>

  
  <script>
    let offset = 0; // Décalage pour la requête de la prochaine série d'équipements
    const limit = 10; // Nombre d'éléments à la fois

    // Fonction pour charger dynamiquement l'équipement
    function loadEquipment() {
      fetch(`load-equipment.php?offset=${offset}&limit=${limit}`)
        .then(response => response.json())
        .then(data => {
          data.forEach(item => {
            const equipmentItem = `<div class="card">
              <img class="card-img-top" src="${item.image}" alt="${item.name}">
              <div class="card-body">
                <h5 class="card-title">${item.name}</h5>
                <p class="card-text">${item.description}</p>
                <p class="card-text">Prix : ${item.price}</p>
              </div>
            </div>`;
            document.getElementById('equipment-list').insertAdjacentHTML('beforeend', equipmentItem);
          });
          offset += limit; // Augmenter le décalage
        })
        .catch(error => {
          console.error('Erreur lors du chargement de l\'équipement:', error);
        });
    }

    // Chargement initial de l'équipement
    loadEquipment();

    // Gestionnaire d'événements pour le bouton "Charger plus"
    document.getElementById('load-more').addEventListener('click', loadEquipment);
  </script>
  <script src="dist/bundle.js"></script>
</body>
</html>
