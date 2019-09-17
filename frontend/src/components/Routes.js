import React from 'react'

import { Router, Switch, Route } from 'react-router'

import Login from '../pages/login/Login'
import Register from '../pages/register/Register'
import Home from '../pages/home/Home'
import NotFound from './NotFound'
import PrivateRoute from './PrivateRoute'
import Auth from './Auth'

import {history} from '../history'

const Routes = () => (
    <Router history={history}>
        <Switch>
            <Auth component={Login} exact path="/login"/>
            <Route component={Register} exact path="/register"/>
            <PrivateRoute component={Home} exact path="/"/>
            <PrivateRoute component={NotFound}/>
        </Switch>
    </Router>
)

export default Routes
