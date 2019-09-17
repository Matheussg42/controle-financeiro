import React from 'react'
import { Route, Redirect } from 'react-router'

const GetLogin = props => {
    const isLogged = !!localStorage.getItem('app-token')
    return isLogged ? <Redirect to="/"/> : <Route {...props}/>
}

export default GetLogin