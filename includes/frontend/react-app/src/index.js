import React from "react";
import ReactDOM from "react-dom/client"; // Notez le changement ici
import ChatBox from "./components/ChatBox";
import "./styles.css";

const root = ReactDOM.createRoot(
  document.getElementById("charlotte-react-root")
);
root.render(<ChatBox />);
