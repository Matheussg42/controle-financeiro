import './Nav.css'
import React from 'react'
import { Link } from 'react-router-dom'
import { Redirect } from 'react-router'

const logout = async e => {
    const isLogged = !!localStorage.getItem('app-token')
    if (isLogged) {
        await localStorage.removeItem('app-token');
        await <Redirect to="/login" />
    }

    e.persist();
    // const isLogged = !!localStorage.getItem('app-token')
    // return isLogged ? <Redirect to="/"/> : <Route {...props}/>
}

const dropdown = async () => {
    this.
}

export default props =>
    <aside className="menu-area">
        <nav className="menu">
            <Link to="/">
                <i className="fa fa-bar-chart"></i> Dashboard
            </Link>
            <Link to="/" onClick={dropdown} data-toggle="collapse" aria-expanded="false" className="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div className="d-flex w-100 justify-content-start align-items-center">
                    <span className="fa fa-dashboard fa-fw mr-3"></span>
                    <span className="menu-collapsed">Dashboard</span>
                    <span className="submenu-icon ml-auto"></span>
                </div>

                <div id='submenu1' className="collapse sidebar-submenu">
                    <Link href="#" className="list-group-item list-group-item-action bg-dark text-white">
                        <span className="menu-collapsed">Charts</span>
                    </Link>
                    <Link href="#" className="list-group-item list-group-item-action bg-dark text-white">
                        <span className="menu-collapsed">Reports</span>
                    </Link>
                    <Link href="#" className="list-group-item list-group-item-action bg-dark text-white">
                        <span className="menu-collapsed">Tables</span>
                    </Link>
                </div>
            </Link>
            <Link to="#" onClick={logout}>
                <i className=""></i>Logout
            </Link>
        </nav>
    </aside>