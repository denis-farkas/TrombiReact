import React, { Fragment } from 'react';
import Header from './components/Header';
import imagen from './img/ban.jpg';
import styled from '@emotion/styled';
import Login from './components/auth/Login';
import Home from './components/Home';
import { Route, Switch } from 'react-router-dom';

const Imagen = styled.img`
  display: block;
  margin-left:auto;
  margin-right:auto;
  width: 80%;
  height: auto;
  `
function App() {
  return (
    
    <Fragment>
    <Imagen
      src={imagen}
      alt="image personnel"
     />
      <Header
        titulo='Administration personnel'
      />
      
      <Switch>
      <Route  path="/" component={Home} exact />
      <Route  path="/login" component={Login} />
      </Switch>
    </Fragment>
      
    
    
  );

}


export default App;
