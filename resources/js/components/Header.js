import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { BrowserRouter, Link, NavLink, Route, Redirect, Switch } from 'react-router-dom'

class Header extends React.Component {
    constructor() {
        super()

        this.userLogged = localStorage.getItem('userLogged');
    }

    render() {
        return (
            <header className="header-desktop">
                <div className="section__content section__content--p30">
                    <div className="container-fluid">
                        <div className="header-wrap">
                            <div className="form-header"></div>
                            <div className="header-button">
                                <div className="account-wrap">
                                    <div className="account-item clearfix js-item-menu">
                                        <div className="content">
                                            <a className="js-acc-btn" href="#">{this.props.user.name}</a>
                                        </div>
                                        <div className="account-dropdown js-dropdown">
                                            <div className="info clearfix">
                                                <div className="content">
                                                    <h5 className="name">
                                                        <a href="#">{this.props.user.name}</a>
                                                    </h5>
                                                    <span className="email">{this.props.user.email}</span>
                                                </div>
                                            </div>
                                            <div className="account-dropdown__body">
                                                <div className="account-dropdown__item">
                                                    <a href="#">
                                                        <i className="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                            </div>
                                            <div className="account-dropdown__footer">
                                                <a href="#">
                                                    <i className="zmdi zmdi-power"></i>{this.props.logout}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            // <header className="header-desktop4">
            //     <div className="container">
            //         <div className="header4-wrap">
            //             <div className="header__logo">
            //                 <a href="#">
            //                     <img src="images/icon/logo-blue.png" alt="CoolAdmin" />
            //                 </a>
            //             </div>
            //             <div className="header__tool">
            //                 <div className="account-wrap">
            //                     <div className="account-item account-item--style2 clearfix js-item-menu">
            //                         <div className="content">
            //                             <a className="js-acc-btn" href="#">{this.props.user.name}</a>
            //                         </div>
            //                         <div className="account-dropdown js-dropdown">
            //                             <div className="info clearfix">
            //                                 <div className="content">
            //                                     <h5 className="name">
            //                                         <a href="#">{this.props.user.name}</a>
            //                                     </h5>
            //                                     <span className="email">{this.props.user.email}</span>
            //                                 </div>
            //                             </div>
            //                             <div className="account-dropdown__body">
            //                                 <div className="account-dropdown__item">
            //                                     <a href="#">
            //                                         <i className="zmdi zmdi-account"></i>Conta
            //                                     </a>
            //                                 </div>
            //                             </div>
            //                             {this.props.isAuthenticated ?
            //                                 <div className="account-dropdown__footer">
            //                                     <a href="#" onClick={this.props.logout}>
            //                                         <i className="zmdi zmdi-power"></i>Logout
            //                                     </a>
            //                                 </div>
            //                             : 
            //                                 null
            //                             }   
            //                         </div>
            //                     </div>
            //                 </div>
            //             </div>
            //         </div>
            //     </div>
            // </header>
        )
    }
}

export default Header