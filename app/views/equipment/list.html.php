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
      <div id="type-filter" class="col-md-3">
        <div class="list-group">
          <a href="#" class="list-group-item list-group-item-action" data-type="ordi_portable">Ordinateurs portables</a>
          <a href="#" class="list-group-item list-group-item-action" data-type="ecran_ordinateur">Ecrans d'ordinateurs</a>
          <a href="#" class="list-group-item list-group-item-action" data-type="smartphone">Smartphones</a>
          <a href="#" class="list-group-item list-group-item-action" data-type="accessoire">Accessoires</a>
          <a href="#" class="list-group-item list-group-item-action" data-type="tablette">Tablettes</a>
          <a href="#" class="list-group-item list-group-item-action" data-type="Casque_vr">Casque VR</a>
        </div>
      </div>
      <div id="equipment-list" class="col-md-9">
        <!-- Здесь будут отображаться карточки оборудования -->
      </div>
      <div class="col-md-12 text-center">
        <button id="load-more" class="btn btn-primary mt-3">Charger plus</button>
      </div>
    </div>
  </div>

  <?php include '../shared/footer.html.php'; ?>

  <script>
    let offset = 0;
    const limit = 10;

    function loadModel(type = '') {
      fetch(`../../../config/load-equipment.php?type=${type}&offset=${offset}&limit=${limit}`)
        .then(response => response.json())
        .then(data => {
          const container = document.getElementById('equipment-list');
          container.innerHTML = '';
          data.forEach(item => {
            const modelItem = `<div class="card mb-3" data-id="${item.id}">
            <div class="row no-gutters">
              <div class="col-md-4">
                <img src="${item.photo}" class="card-img" alt="${item.name}">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">${item.name}</h5>
                  <p class="card-text">${item.description}</p>
                </div>
              </div>
            </div>
          </div>`;
            container.insertAdjacentHTML('beforeend', modelItem);
          });
        })
        .catch(error => {
          console.error('Erreur lors du chargement de l\'équipement:', error);
        });
    }

    document.querySelectorAll('#type-filter .list-group-item').forEach(item => {
      item.addEventListener('click', function(event) {
        event.preventDefault();
        const type = this.getAttribute('data-type');
        loadModel(type);
        // Обновляем класс 'active' для элементов списка
        document.querySelectorAll('#type-filter .list-group-item').forEach(i => i.classList.remove('active'));
        this.classList.add('active');
        offset = 0; // Сбрасываем смещение при смене типа
      });
    });

    // Начальная загрузка оборудования по умолчанию
    loadModel();

    document.getElementById('load-more').addEventListener('click', function() {
      const activeType = document.querySelector('#type-filter .list-group-item.active').getAttribute('data-type');
      offset += limit;
      loadModel(activeType);
    });

    function redirectToDetails(id) {
      window.location.href = `./item.html.php?id=${id}`;
    }
  </script>
  <script src="../../../dist/bundle.js"></script>
</body>

</html>