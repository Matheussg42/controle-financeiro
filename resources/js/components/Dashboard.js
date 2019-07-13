import axios from 'axios'
import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { BrowserRouter, Link, NavLink, Route, Redirect, Switch } from 'react-router-dom'
import Header from './Header'
import Breadcrumb from './Breadcrumb';

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
                <Header {...this.props} />
                <Breadcrumb />

                <section>
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-3">
                            </div>
                        </div>
                    </div>
                </section>
            </React.Fragment>
        )
    }
}

export default Dashboard