import './DataTable.css'
import 'bootstrap/dist/css/bootstrap.min.css'
import React, { Component } from 'react';

class DataTable extends Component {
    renderTableHead() {
        if(this.props.tables != null){
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
        if(this.props.tables != null){
            
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
        return(
            <table className="table">
                <thead>
                    {this.renderTableHead()}
                </thead>
                <tbody className="table-striped">
                    {this.renderTableBody()}
                </tbody>
            </table>
        )
    }
}

export default DataTable;