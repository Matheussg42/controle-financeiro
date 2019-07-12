import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { BrowserRouter, NavLink, Route, Redirect, Switch } from 'react-router-dom'
import Header from './Header'
import Login from './Login'
import Dashboard from './Dashboard'

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
		const lsUser = JSON.parse(localStorage.getItem('userLogged'));
		if (lsToken && lsUser) {
			this.authenticate(lsToken, lsUser);
		}
	}

	authenticate(token, user) {
		this.setState({
			isAuthenticated: true,
			token: token,
			user: user
		});
		let userLogged = JSON.stringify(user);
		localStorage.setItem('jwt', token);
		localStorage.setItem('userLogged', userLogged);
	}

	logout() {
		this.setState({
			isAuthenticated: false,
			token: null
		});

		localStorage.removeItem('jwt');
		localStorage.removeItem('userLogged');
	}

	render() {
		return (
			<BrowserRouter>
				<div>
					<Switch>	
						<PrivateRoute exact path='/dashboard' component={Dashboard} isAuthenticated={this.state.isAuthenticated} logout={this.state.logout} user={this.state.user} token={this.state.token} />	
						<Route exact path='/login' render={(props) => <Login authenticate={this.authenticate} isAuthenticated={this.state.isAuthenticated} {...props} />} />
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

ReactDOM.render(<App />, document.getElementById('app'))