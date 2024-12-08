import React, { useState } from "react";

const ChatBox = () => {
  const [messages, setMessages] = useState([]);
  const [input, setInput] = useState("");
  const [loading, setLoading] = useState(false);

  const sendMessage = async () => {
    if (!input.trim()) return;

    const userMessage = { sender: "user", text: input };
    setMessages([...messages, userMessage]);

    setLoading(true);
    try {
      const response = await fetch(ajaxurl, {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({
          action: "charlotte_ai_process",
          message: input,
        }),
      });

      const botResponse = await response.json();

      setMessages((prevMessages) => [
        ...prevMessages,
        { sender: "bot", text: botResponse.reply || "Erreur de réponse." },
      ]);
    } catch (error) {
      console.error("Erreur:", error);
      setMessages((prevMessages) => [
        ...prevMessages,
        { sender: "bot", text: "Erreur de communication avec le serveur." },
      ]);
    } finally {
      setLoading(false);
      setInput("");
    }
  };

  return (
    <div className="chat-box">
      <div className="chat-header">Parlez à Charlotte</div>
      <div className="chat-messages">
        {messages.map((msg, index) => (
          <div
            key={index}
            className={msg.sender === "user" ? "user-message" : "bot-message"}
          >
            {msg.text}
          </div>
        ))}
      </div>
      <div className="chat-input">
        <input
          type="text"
          value={input}
          onChange={(e) => setInput(e.target.value)}
          placeholder="Écrivez votre message ici..."
          disabled={loading}
        />
        <button onClick={sendMessage} disabled={loading}>
          {loading ? "Chargement..." : "Envoyer"}
        </button>
      </div>
    </div>
  );
};

export default ChatBox;
