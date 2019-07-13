import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { BrowserRouter, Link, NavLink, Route, Redirect, Switch } from 'react-router-dom'

class Breadcrumb extends Component {

    render() {
        return (

            <section class="welcome2 p-t-40 p-b-40">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="au-breadcrumb3">
                                <div class="au-breadcrumb-left">
                                    <span class="au-breadcrumb-span">Você esta em:</span>
                                    <ul class="list-unstyled list-inline au-breadcrumb__list">
                                        <li class="list-inline-item active">
                                            <a href="#">Home</a>
                                        </li>
                                        <li class="list-inline-item seprate">
                                            <span>/</span>
                                        </li>
                                        <li class="list-inline-item">Dashboard</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        )
    }
}

export default Breadcrumb