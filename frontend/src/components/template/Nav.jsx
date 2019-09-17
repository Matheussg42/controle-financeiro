import './Nav.css'
import React from 'react'
import { Link } from 'react-router-dom'
import { Redirect } from 'react-router'

const logout = async e => {
    const isLogged = !!localStorage.getItem('app-token')
    if(isLogged){
        await localStorage.removeItem('app-token');
        await <Redirect to="/login"/>
    }

    e.persist();
    // const isLogged = !!localStorage.getItem('app-token')
    // return isLogged ? <Redirect to="/"/> : <Route {...props}/>
}

export default props =>
    <aside className="menu-area">
        <nav className="menu">
            <Link to="/">
                <i className="fa fa-bar-chart"></i> Dashboard
            </Link>
            <Link to="#" onClick={logout}>
                <i className=""></i>Logout
            </Link>
        </nav>
    </aside>