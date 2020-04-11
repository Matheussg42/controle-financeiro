import React from 'react';
import { Link, useHistory } from 'react-router-dom';
import { FiPower } from 'react-icons/fi';

import logoImg from '../assets/logo2.png';

export default function Header() {
  const history = useHistory();

  function handleLogout() {
    localStorage.clear();

    history.push('/');
  }

  return (
    <div className="profile-container header">
      <header>
        <img src={logoImg} alt="FinancialManagement" />

        <div>
          <Link className="button" to="/dashboard">Dashboard</Link>
          <Link className="button" to="/financas">Mês Atual</Link>
          <Link className="button" to="/dashboard">Ano Atual</Link>
          <Link className="button" to="/dashboard">Historico</Link>
          <button onClick={handleLogout} type="button">
            <FiPower size={18} color="#fff" />
          </button>
        </div>
      </header>
    </div>
  );
}