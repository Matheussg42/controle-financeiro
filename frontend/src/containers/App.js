import 'bootstrap/dist/css/bootstrap.min.css'
import 'font-awesome/css/font-awesome.min.css'
import './App.css'
import React from 'react'

import Routes from '../components/Routes'

import './App.css'


// if(window.location.pathname === '/login'){
    var App = () => (
        <main className="app">
            <Routes/>
        </main>
    )
// }
// else{
//     var App = () => (
//         <BrowserRouter>
//             <div className="app">
//                 <Logo />
//                 <Nav />
//                 <Routes />
//                 <Footer />
//             </div>
//         </BrowserRouter>
//     )
// }



export default App