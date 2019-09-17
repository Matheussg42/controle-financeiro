import React from 'react';
import { Redirect } from 'react-router-dom';

class Login extends React.Component {
    constructor() {
        super();
        this.state = {
            email: '',
            password: '',
            error: ''
        };
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleChange(event) {
        const name = event.target.name;
        this.setState({
            [name]: event.target.value
        });
    }

    handleSubmit(event) {
        $("#login-form-button")
            .attr("disabled", "disabled")
            .html(
                '<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i><span class="sr-only">Loading...</span>'
            );

        event.preventDefault();
        axios.post('http://127.0.0.1:8000/api/login', {
            email: this.state.email,
            password: this.state.password
        })
            .then((response) => {
                this.setState({ error: '' });
                const token = response.data.token;
                const user = response.data.user;
                this.props.authenticate(token, user);
            }).then(() => {
                $("#login-form-button")
                    .removeAttr("disabled")
                    .html("Login");
            })
            .catch((error) => {
                const status = error.response.status;
                if (status === 401) {
                    this.setState({ error: 'Username or password not recognised.' });
                }
            });
    }

    render() {
        if (this.props.isAuthenticated && this.props.location.state !== undefined) {
            return (
                <Redirect to={this.props.location.state.from} />
            );
        }
        return (
            <div>
                {this.state.error !== '' ?
                    <p className="text-danger">{this.state.error}</p>
                    :
                    null
                }
                {this.props.isAuthenticated ?
                    <Redirect to='/dashboard' />
                    :
                    <div className="page-wrapper">
                        <div className="page-content--bge5">
                            <div className="container">
                                <div className="login-wrap">
                                    <div className="login-content">
                                        <div className="login-form">
                                            <form onSubmit={this.handleSubmit}>
                                                <div className='form-group'>
                                                    <input
                                                        className="au-input au-input--full"
                                                        name='email'
                                                        type='email'
                                                        className='form-control'
                                                        placeholder='Email'
                                                        value={this.state.email}
                                                        onChange={this.handleChange} />
                                                </div>

                                                <div className='form-group'>
                                                    <input
                                                        className="au-input au-input--full"
                                                        name='password'
                                                        type='password'
                                                        className='form-control'
                                                        placeholder='Password'
                                                        value={this.state.password}
                                                        onChange={this.handleChange} />
                                                </div>

                                                <div className='form-group'>
                                                    <input className="au-btn au-btn--block au-btn--green m-b-20" type='submit' className='btn' value='Login' />
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                }
            </div>
        );
    }
}

export default Login;