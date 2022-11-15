import React, { useState, useEffect } from "react";
import axios from "axios";

const UserEdit = ({ userId }) => {
    const [user, setUser] = useState({});

    useEffect(() => {
        axios
            .get(`http://localhost:8000/api/users/${userId}`)
            .then((res) => setUser(res.data))
            .catch((err) => console.log("err from user edit ", err));
    }, []);

    return (
        <div>
            Edit
            {user.name}
        </div>
    );
};

export default UserEdit;
