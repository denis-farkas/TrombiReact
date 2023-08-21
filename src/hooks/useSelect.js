import React, {useState} from 'react';

const useSelect = (stateInicial, opciones) => {
   
    const [state, actualizarState] = useState(stateInicial);

    const SelectCategorie = () => (
        <select
            className="browser-default"
            value={state}
            onChange={e => actualizarState(e.target.value)}
            >
               {opciones.map(opcion => (
                   <option key={opcion.value} value={opcion.value}>{opcion.label}</option>
               ))}
            </select>
    );

    return [state, SelectCategorie];
}
 
export default useSelect;