import React from 'react';
import { Link, useHistory } from 'react-router-dom';
import { FiPower } from 'react-icons/fi';
import { AppBar, Toolbar, makeStyles  } from '@material-ui/core';

import logoImg from '../assets/logo2.png';

const useStyles = makeStyles((theme) => ({
  root: {
    flexGrow: 1,
  },
  menu:{
    background: '#1f7fc0',
    marginBottom: '15px'
  },
  title: {
    flexGrow: 1,
  },
  imgLogo: {
    width: 160,
  },
  menuLink: {
    color: '#fff',
    textDecoration: 'none',
    textTransform: 'uppercase',
    fontWeight: 600,
    padding: '10px 20px',
  },
  menuButton:{
    marginRight: theme.spacing(2),
    background: 'none',
    border: 'none'
  },
}));

export default function Header() {
  const classes = useStyles();

  const history = useHistory();

  function handleLogout() {
    localStorage.clear();

    history.push('/');
  }

  return (
    <div className={classes.root}>
      <AppBar className={classes.menu} position="static">
        <Toolbar>
          <Link to="/financas" className={`${classes.title}`}>
            <img src={logoImg} className={classes.imgLogo} alt="FinancialManagement" />
          </Link>

          <Link className={classes.menuLink} color="inherit" to="/financas">Mês Atual</Link>
          <Link className={classes.menuLink} color="inherit" to="/ano">Ano Atual</Link>
          <Link className={classes.menuLink} color="inherit" to="/historico">Historico</Link>
          <button className={classes.menuButton} onClick={handleLogout} type="button">
            <FiPower size={18} color="#fff" />
          </button>
        </Toolbar>
      </AppBar>
    </div>
  );
}