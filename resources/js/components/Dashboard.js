import axios from 'axios'
import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { BrowserRouter, Link, NavLink, Route, Redirect, Switch } from 'react-router-dom'
import Header from './Header'

class Dashboard extends Component {
    constructor() {
        super()
        this.state = {
            projects: []
        }
    }



    render() {
        
        return (
            <Header {...this.props} />
        )
    }
}

export default Dashboard