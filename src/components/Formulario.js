import React from 'react';
import styles from './Formulario.module.css';
import useSelect from '../hooks/useSelect';

const Formulario = ({guardarCategoria}) => {

    const OPCIONES = [
        { value: 'oui', label: 'Générale'},
        { value: 'adm', label: 'Administration'},
        { value: 'enc', label: 'Encadrement'},
        { value: 'dev', label: 'Développement'},
        { value: 'dat', label: 'Analyse Data'},
    ]

    const [ categoria, SelectCategorie] = useSelect('general', OPCIONES);

    const buscarPersonnel = e => {
        e.preventDefault();

        guardarCategoria(categoria);
    }


    return ( 
        <div className={`${styles.buscador} row`}>
            <div className="col s12 m8 offset-m2">
                <form
                    onSubmit={buscarPersonnel}
                >
                    <h2 className={styles.heading}>Personnel par catégorie</h2>
                    <SelectCategorie />
                    <div className="input-field col s12">
                        <input
                        type="submit"
                        className={` ${styles.btn_block} btn-large amber darken-2`}
                        value="Sélectionner"
                        />
                    </div>
                </form>
            </div>
        </div>
     );
}
 
export default Formulario;