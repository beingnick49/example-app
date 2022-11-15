// // import './bootstrap';
import React from "react";
import ReactDOM from "react-dom/client";
import UserList from "./UserList";
import { BrowserRouter } from "react-router-dom";

const App = () => {
    return (
        <div>
            <UserList />
        </div>
    );
};

ReactDOM.createRoot(document.getElementById("root")).render(
    <BrowserRouter>
        <App />
    </BrowserRouter>
);
