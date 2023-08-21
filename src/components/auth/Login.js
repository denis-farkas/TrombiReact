import React, {useState} from 'react';
import styled from '@emotion/styled';

const Contenedor = styled.div`
display: flex;
width:80%;
height: 400px;
padding: 2rem;
justify-content: center;
`;

const Login = () => {

    const [usuario, guardarUsuario] = useState({
        email:'',
        password:''
    });

    const { email, password} = usuario;

    const onChange = e =>{
        guardarUsuario({
            ...usuario,
            [e.target.name] : e.target.value
        })
    }
const onSubmit = e => {

e.preventDefault()
    var axios = require('axios');
var data = JSON.stringify({"email":"defar@r.com","password":"test"});

var config = {
  method: 'post',
  url: 'https://cloudefar.fr/TrombiReact/api/login.php',
  headers: { 
    'Content-Type': 'application/json'
  },
  data : data
};

axios(config)
.then(function (response) {
  console.log(JSON.stringify(response.data));
})
.catch(function (error) {
  console.log(error);
});
};
  
        

    return ( 
        <div id="conta" className="container white">

        <div className="form-usuario">
       
            <Contenedor>
                

                <form
                    onSubmit={onSubmit}
                >
                   <div className="campo-form">
                       <label htmlFor="email">Email</label>
                       <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="votre email"
                        value={email}
                        onChange={onChange} />
                   </div> 

                    <div className="campo-form">
                       <label htmlFor="password">Password</label>
                       <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="votre password"
                        value={password}
                        onChange={onChange} />
                   </div> 

                   <div className="campo-form">
                   <input type="submit" className="btn btn-primario btn-block"
                   value="Login"/>
                   </div>
                </form>
            </Contenedor>
        </div>
        </div>
     );
}
 
export default Login;