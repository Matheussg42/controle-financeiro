import 'bootstrap/dist/css/bootstrap.min.css'
import "jquery";
import "react-popper";
import 'bootstrap/dist/js/bootstrap.min.js'
import React, { Component } from 'react';

import DataTable from './../../components/template/DataTable'
import {Api} from './../../components/Api'
import axios from 'axios'

class MonthDataTable extends Component {

    // constructor(props){
    //     super(props);
    //     this.state = { 
    //         currentIncome: {},
    //         currentPayment: {}
    //     };
    //     this.currentIncome();
    //     // this.currentPayment();
    //     console.log(this.props)
    // }

    renderTableHead() {
        if(this.props.tables[0] !== undefined){
            let tableKeys = Object.keys(this.props.tables[0]);
            return (
                <tr key={tableKeys.id}>
                    {this.tableHeadKeys(tableKeys)}
                </tr>
            )
        }
    }

    tableHeadKeys(keys){
        return keys.map(keys => {
            return (
                <th key={keys}>{keys}</th>
            )
        })
    }

    renderTableBody() {
        if(this.props.tables[0] !== undefined){
            
            return this.props.tables.map((tables, index) => {
                const { id } = tables //destructuring
                return (
                   <tr key={id}>
                       {this.tableBodyItens(id, tables)}
                   </tr>
                )
            })
            
        }
    }

    tableBodyItens(id,body){
        var i=0;
        return Object.keys(body).map(itens => {
            var itemId = i;
            i++
            return (
                <td key={`${id}_${itemId}`}>{body[itens]}</td>
            )
        })
    }

    render() {
        // console.log(this.props.income)
        console.log(this.props)
        return(
            <section>
                <nav>
                    <div className="nav nav-tabs" id="nav-tab" role="tablist">
                        <a className="nav-item nav-link active" id="income-month-tab" data-toggle="tab" href="#income-month" role="tab" aria-controls="income-month" aria-selected="true">Income</a>
                        <a className="nav-item nav-link" id="payment-month-tab" data-toggle="tab" href="#payment-month" role="tab" aria-controls="payment-month" aria-selected="false">Payment</a>
                        <a className="nav-item nav-link" id="bill-mont-tab" data-toggle="tab" href="#bill-mont" role="tab" aria-controls="bill-mont" aria-selected="false">Bills</a>
                    </div>
                </nav>
                <div className="tab-content" id="nav-tabContent">
                    <div className="tab-pane fade show active" id="income-month" role="tabpanel" aria-labelledby="income-month-tab">
                        <DataTable tables={this.props.currentIncome}/>
                    </div>
                    <div className="tab-pane fade" id="payment-month" role="tabpanel" aria-labelledby="payment-month-tab">b</div>
                    <div className="tab-pane fade" id="bill-mont" role="tabpanel" aria-labelledby="bill-mont-tab">c</div>
                </div>
            </section>
        )
    }
}

export default MonthDataTable;