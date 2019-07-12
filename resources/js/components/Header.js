import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { BrowserRouter, Link, NavLink, Route, Redirect, Switch } from 'react-router-dom'

class Header extends React.Component {
    constructor() {
        super()

        const userLogged = localStorage.getItem('userLogged');
        const token = localStorage.getItem('jwt');
    }

    render() {
        console.log(this.props.logout);
        return (
            
        <nav className='navbar navbar-expand-md navbar-light navbar-laravel'>
            <div className='container'>
                <Link className='navbar-brand' to='/'>NavBar</Link>
            
                {this.props.isAuthenticated ?
                    <li>
                        <a href="#" onClick={this.props.logout}>
                            Logout
                        </a>
                    </li>
                : 
                null
                }
            </div>
        </nav>
        )
    }
}

export default Header