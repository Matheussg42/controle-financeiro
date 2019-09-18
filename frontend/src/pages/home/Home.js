import React from 'react'
import Main from './../../components/template/Main'
import Logo from './../../components/template/Logo'
import Footer from './../../components/template/Footer'
import Nav from './../../components/template/Nav'
import DataTable from './../../components/template/DataTable'

import {Api} from './../../components/Api'
import axios from 'axios'

class Home extends React.Component {
    constructor(props){
        super(props);
        this.state = {
            months: []
        };
    }
      
    async componentDidMount() {
        this.setState({months: await this.renderPosts()});
        this.headerProps = {
            icon: 'bar-chart',
            title: 'Dashboard',
        }

    }


    renderPosts = async() => {
        const months = await axios.get( 
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

        return months;
    }

    render() {
        return(
            <React.Fragment>
                <Logo />
                <Nav />
                <div className="page-home">
                    <Main {...this.headerProps}>
                        <div>
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
