import React, { useState, useEffect } from "react";
import { AgGridReact } from "ag-grid-react";
import axios from "axios";
import UserEdit from "./UserEdit";
import { useHistory } from "react-router-dom";

import "ag-grid-community/styles/ag-grid.css";
import "ag-grid-community/styles/ag-theme-alpine.css";

const UserList = () => {
    const router = useHistory();

    const [user, setUser] = useState([]);
    const [users, setUsers] = useState([]);

    const [columnDefs] = useState([
        {
            field: "name",
            filter: "agTextColumnFilter",
            filterParams: {
                textCustomComparator: (filter, value, filterText) => {
                    const filterTextLowerCase = filterText.toLowerCase();
                    const valueLowerCase = value.toString().toLowerCase();
                    switch (filter) {
                        case "contains":
                            return (
                                valueLowerCase.indexOf(filterTextLowerCase) >= 0
                            );
                        default:
                            // should never happen
                            console.warn("invalid filter type " + filter);
                            return false;
                    }
                },
            },
            sortable: true,
        },
        {
            field: "email",
            filter: "agTextColumnFilter",
            filterParams: {
                textCustomComparator: (filter, value, filterText) => {
                    const filterTextLowerCase = filterText.toLowerCase();
                    const valueLowerCase = value.toString().toLowerCase();
                    switch (filter) {
                        case "contains":
                            return (
                                valueLowerCase.indexOf(filterTextLowerCase) >= 0
                            );
                        default:
                            // should never happen
                            console.warn("invalid filter type " + filter);
                            return false;
                    }
                },
            },
            sortable: true,
        },
        { field: "created_at" },
    ]);

    useEffect(() => {
        axios
            .get("http://localhost:8000/api/users")
            .then((res) => setUsers(res.data))
            .catch((err) => console.log("err", err));
    }, []);

    const getUser = (id) => {
        router.push(`/admin/users/${id}/edit`);
    };

    return (
        <div>
            <UserEdit />
            User List
            <div
                className="ag-theme-alpine"
                style={{ height: 400, width: 600 }}
            >
                <AgGridReact
                    rowData={users}
                    columnDefs={columnDefs}
                    onRowClicked={(text) => getUser(text.data.id)}
                ></AgGridReact>
            </div>
        </div>
    );
};

export default UserList;
