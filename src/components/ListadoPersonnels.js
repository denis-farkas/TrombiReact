import React from 'react';
import Personnel from './Personnel';

const ListadoPersonnels = ({personnels}) => (
    <div className="row">
        {personnels.map(personnel => (
            <Personnel 
                key={personnel.id}
                personnel={personnel}
            />
        ))}
    </div>
);
 
export default ListadoPersonnels;