import axios from 'axios'
import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { BrowserRouter, Link, NavLink, Route, Redirect, Switch } from 'react-router-dom'
import Header from './Header'
import Sidebar from './Sidebar';

class Dashboard extends Component {
    constructor() {
        super()
        this.state = {
            projects: []
        }
    }



    render() {
        
        return (
            <React.Fragment>
                <Sidebar {...this.props} />
                <Header {...this.props} />

                <div className="page-container">
                    <div className="main-content">

                    </div>
                </div>
            </React.Fragment>
        )
    }
}

export default Dashboard