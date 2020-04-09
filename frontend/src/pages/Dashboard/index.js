import React from 'react';
import { Link, useHistory } from 'react-router-dom';
import { FiPower } from 'react-icons/fi';

// import api from '../../services/api';

import './styles.css';

import logoImg from '../../assets/logo2.png';

export default function Dashboard() {
  // const [incidents, setIncidents] = useState([]);

  const history = useHistory();

  const token = localStorage.getItem('token');
  const user = JSON.parse(localStorage.getItem('user'));

  function handleLogout() {
    localStorage.clear();

    history.push('/');
  }

  return (
    <React.Fragment>
      <div className="profile-container header">
        <header>
          <img src={logoImg} alt="FinancialManagement" />

          <div>
            <Link className="button" to="/dashboard">Dashboard</Link>
            <Link className="button" to="/dashboard">Mês Atual</Link>
            <Link className="button" to="/dashboard">Ano Atual</Link>
            <Link className="button" to="/dashboard">Historico</Link>
            <button onClick={handleLogout} type="button">
              <FiPower size={18} color="#fff" />
            </button>
          </div>
        </header>
      </div>

      {/* <div className="profile-container">
        <h1></h1>

      </div> */}
    </React.Fragment>
  );
}