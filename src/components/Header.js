import React, { Fragment } from 'react';
import { Link } from "react-router-dom";

const navStyle = {
    padding: '0px 60px' , 
};


const Header = ({titulo}) => {
    return ( 
        <Fragment> 
        <nav className="nav-wrapper light-blue darken-3" style={navStyle}>
        <div className="nav-wrapper">

        <a href="/" className="brand-logo center">{titulo}</a>
        
        <ul className="right">
          <li><Link to ="/Login">Login</Link></li>  
        </ul>
        </div>
        
        </nav>
         </Fragment>     
        
     );
}
 
export default Header ;