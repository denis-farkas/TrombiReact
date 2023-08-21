import React, { Fragment, useEffect, useState } from 'react';
import Formulario from './Formulario';
import ListadoPersonnels from './ListadoPersonnels';

function Home() {

    const[categoria, guardarCategoria] = useState('');
    const[personnels, guardarPersonnels] = useState([]);
  
    useEffect(() => {
      const consultarAPI = async () => {
        const url = `http://cloudefar.fr/TrombiReact/api/product/search.php?s=${categoria}`;
  
        const repuesta = await fetch(url);
        const personnels= await repuesta.json();
  
        guardarPersonnels(personnels.records);
      }
      consultarAPI();
    }, [categoria]);

    return (
        <Fragment>
            <div id="cont" className="container white">
                <Formulario
                guardarCategoria={guardarCategoria}

                />
                <ListadoPersonnels 
                personnels={personnels}
                />
            </div>
        </Fragment>
    )
}
export default Home;
    

    
  