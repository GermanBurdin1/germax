<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Location d'équipement</title>
 
</head>
<body>
  <?php include '../shared/header.html.php'; ?>

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

  <?php include '../shared/footer.html.php'; ?>
  
  <script>
  let offset = 0; // Décalage pour la requête de la prochaine série d'équipements
  const limit = 10; // Nombre d'éléments à la fois

  // Fonction pour charger dynamiquement l'équipement
  function loadModel() {
    fetch(`../../../config/load-equipment.php?offset=${offset}&limit=${limit}`)
      .then(response => response.json())
      .then(data => {
        const container = document.getElementById('equipment-list');
        data.forEach(item => {
          const modelItem = `<div class="card" data-id="${item.id}">
            <img class="card-img-top" src="${item.photo}" alt="${item.name}">
            <div class="card-body">
              <h5 class="card-title">${item.name}</h5>
              <p class="card-text">${item.description}</p>
            </div>
          </div>`;
          container.insertAdjacentHTML('beforeend', modelItem);

          // Получение только что добавленной карточки и добавление обработчика события
          const cards = container.getElementsByClassName('card');
          const lastCard = cards[cards.length - 1];
          lastCard.addEventListener('click', () => redirectToDetails(item.id));
        });
        offset += limit; // Augmenter le décalage
      })
      .catch(error => {
        console.error('Erreur lors du chargement de l\'équipement:', error);
      });
  }

  // Chargement initial de l'équipement
  loadModel();

  // Gestionnaire d'événements pour le bouton "Charger plus"
  document.getElementById('load-more').addEventListener('click', loadModel);

  function redirectToDetails(id) {
    window.location.href = `./item.html.php?id=${id}`;
  }
  </script>
  <script src="../../../dist/bundle.js"></script>
</body>
</html>
