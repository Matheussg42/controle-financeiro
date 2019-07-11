import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { BrowserRouter, Route, Switch } from 'react-router-dom'
import Header from './Header'
import Home from './Home'
import Login from './Login'

class App extends Component {

    constructor() {
        super();
        this.state = {
            isAuthenticated: false,
            token: null
        };
        this.authenticate = this.authenticate.bind(this);
        this.logout = this.logout.bind(this);
    }

    componentWillMount() {
        const lsToken = localStorage.getItem('jwt');
        if (lsToken) {
            this.authenticate(lsToken);
        }
    }

    authenticate(token) {
        this.setState({
            isAuthenticated: true,
            token: token
        });
        localStorage.setItem('jwt', token);
    }

    logout() {
        this.setState({
            isAuthenticated: false,
            token: null
        });
    }

    render() {
        return (
            <BrowserRouter>
                <div>
                    <Header />
					<Switch>
						<Route exact path='/home' component={Home} />
						<Route exact path='/login' render={(props) => <Login authenticate={this.authenticate} isAuthenticated={this.state.isAuthenticated} {...props} />} />
						{/* <PrivateRoute exact path='/month' component={Month} isAuthenticated={this.state.isAuthenticated} token={this.state.token} refresh={this.refresh} /> */}
					</Switch>
                </div>
            </BrowserRouter>
        )
    }
    
}

const PrivateRoute = ({ component: Component, isAuthenticated, token, ...rest }) => (
	<Route {...rest} render={props => (
		isAuthenticated ? (
			<Component {...props} {...rest} token={token} isAuthenticated={isAuthenticated} />
		) : (
			<Redirect to={{
				pathname: '/login',
				state: { from: props.location }
			}} />
		)
	)} />
);

const Menu = (props) => (
	<ul className="list-inline">
		<li>
			<NavLink exact activeClassName="active" to="/">
				Home
			</NavLink>
		</li>
		<li>
			<NavLink exact activeClassName="active" to="/login">
				Login
			</NavLink>
		</li>
		<li>
			<NavLink exact activeClassName="active" to="/clients">
				Clients
			</NavLink>
		</li>
		{props.isAuthenticated ?
			<li>
				<a href="#" onClick={props.logout}>
					Logout
				</a>
			</li>
			:
			null	
		}
	</ul>
);

ReactDOM.render(<App />, document.getElementById('app'))