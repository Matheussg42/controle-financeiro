import axios from 'axios'
import React, { Component } from 'react'
import { Link } from 'react-router-dom'

class Home extends Component {
    constructor() {
        super()
        this.state = {
            projects: []
        }
    }

    render() {
        return (
            <h1>Logado!</h1>
        )
    }
}

export default Home