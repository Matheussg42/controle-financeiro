import React, { Component } from "react";
import { Redirect } from 'react-router'

class Api extends Component {

    static urlAPI = "http://127.0.0.1:8000/api/v1"
  
    static config = {
        headers: {
           Authorization: "bearer " + localStorage.getItem('app-token')
        }
    }

    static apiExpired() {
        localStorage.removeItem('app-token');
        return <Redirect to='/login' />
    }
}

export { Api };