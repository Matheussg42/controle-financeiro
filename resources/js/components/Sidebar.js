import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { BrowserRouter, Link, NavLink, Route, Redirect, Switch } from 'react-router-dom'

class Sidebar extends Component {

    render() {
        return (

            <aside className="menu-sidebar d-none d-lg-block">
            <div className="logo">
                <a href="#">
                    <img src="images/icon/logo.png" alt="Cool Admin" />
                </a>
            </div>
            <div className="menu-sidebar__content js-scrollbar1">
                <nav className="navbar-sidebar">
                    <ul className="list-unstyled navbar__list">
                        <li>
                            <NavLink exact to="/dashboard">
                                <i className="fas fa-tachometer-alt"></i>Dashboard
                            </NavLink>
                        </li>
                    </ul>
                </nav>
            </div>
            </aside>
        )
    }
}

export default Sidebar