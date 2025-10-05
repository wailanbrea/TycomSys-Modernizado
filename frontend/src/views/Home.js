/*!
=========================================================
* TICOMSYS - Página Principal Original
=========================================================
* Página principal con hero, iconos y animaciones infinitas
=========================================================
*/

import React, { useEffect } from "react";

const Home = () => {
  useEffect(() => {
    // Redirigir a la página principal original de Laravel
    window.location.href = '/';
  }, []);

  return (
    <div className="d-flex justify-content-center align-items-center min-vh-100">
      <div className="text-center">
        <div className="spinner-border text-primary" role="status">
          <span className="sr-only">Cargando...</span>
        </div>
        <p className="mt-3">Redirigiendo a la página principal...</p>
      </div>
    </div>
  );
};

export default Home;
