import React from 'react'
import Main from './../../components/template/Main'
import Logo from './../../components/template/Logo'
import Footer from './../../components/template/Footer'
import Nav from './../../components/template/Nav'
import DataTable from './../../components/template/DataTable'

import urlApi from  './../../components/Api'
import axios from 'axios'

const Home = () =>{
    let yourConfig = {
        headers: {
           Authorization: "bearer " + localStorage.getItem('app-token')
        }
     }

    const months = axios.get( 
        `${urlApi}/months`,
        yourConfig,
    ).then((response) => {
        return response.data.data
    }).catch((error) => {
        console.log(error)
    });

    console.log(months)

    const headerProps = {
        icon: 'bar-chart',
        title: 'Dashboard',
    }

    return(
        <React.Fragment>
            <Logo />
            <Nav />
            <div className="page-home">
                <Main {...headerProps}>
                    <DataTable />
                </Main>
            </div>
            <Footer />
        </React.Fragment>
    )
} 

export default Home
