import React from 'react'
import { Link } from 'react-router-dom'

const Header = (props) => (
    <nav className='navbar navbar-expand-md navbar-light navbar-laravel'>
        <div className='container'>
            <Link className='navbar-brand' to='/'>NavBar</Link>
            {props.isAuthenticated ?
                <li>
                    <a href="#" onClick={props.logout}>
                        Logout
                    </a>
                </li>
			:
			    null	
		    }
        </div>
    </nav>
)

export default Header