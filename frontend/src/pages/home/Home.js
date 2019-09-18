import React from 'react'
import Main from './../../components/template/Main'
import Logo from './../../components/template/Logo'
import Footer from './../../components/template/Footer'
import Nav from './../../components/template/Nav'
import DataTable from './../../components/template/DataTable'

import {Api} from './../../components/Api'
import axios from 'axios'


const initialState = {
    months: []
}

const headerProps = {
    icon: 'bar-chart',
    title: 'Dashboard',
}

class Home extends React.Component {
    state = { ...initialState }

    constructor(props){
        super(props);
        this.renderPosts();
    }

    renderPosts = async() => {
        const result = await axios.get( 
            `${Api.urlAPI}/months`,
            Api.config,
        ).then((response) => {
            return response.data.data
        })
        .catch((error) => {
            if(error.response.data.message === 'Token has expired'){
                Api.apiExpired()
            }
        });

        return this.setState({months: result});
    }

    render() {
        return(
            <React.Fragment>
                <Logo />
                <Nav />
                <div className="page-home">
                    <Main {...headerProps}>
                        <div className="card mt-3" >
                            <div className="card-header">
                                Last Months
                            </div>
                            <DataTable tables={this.state.months}/>
                        </div>
                    </Main>
                </div>
                <Footer />
            </React.Fragment>
        )
    }
}


/*const Home = async () =>{
    

    return(
        <React.Fragment>
            <Logo />
            <Nav />
            <div className="page-home">
                <Main {...headerProps}>
                    <DataTable {...months}/>
                </Main>
            </div>
            <Footer />
        </React.Fragment>
    )
} */

export default Home
