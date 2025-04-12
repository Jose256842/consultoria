document.addEventListener("DOMContentLoaded", () => {
    fetch('obtener_opiniones.php')
      .then(response => response.json())
      .then(data => {
        const contenedor = document.getElementById('contenedor-opiniones');
  
        data.forEach(cliente => {
          const card = document.createElement('div');
          card.classList.add('opinion-card');
  
          card.innerHTML = `
            <img src="img/${cliente.foto}" alt="Foto de ${cliente.nombre}">
            <h4>${cliente.nombre}</h4>
            <p>"${cliente.opinion}"</p>
            <a href="img/${cliente.pdf}" class="descargar-btn" download>Descargar Proyecto</a>
          `;
  
          contenedor.appendChild(card);
        });
      })
      .catch(error => {
        console.error('Error al obtener opiniones:', error);
      });
  });
  