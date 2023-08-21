import React from 'react';

const Personnel = ({personnel}) => {
    const {id, nom, email, fonction, avatar, actif }= personnel;
    return (
        <div className="col s12 m6 l4">
           <div className="card horizontal" >
           <div className="card-image" >
           <img src= {avatar} alt={nom} style={{width:120, height:190}}/>
           </div>

           <div className="card-stacked">
            <div className="card-content">
                <h4>{nom}</h4>
                <p>{email}</p>
            </div>
            </div>
            </div>
            </div>
     );
}

export default Personnel;
