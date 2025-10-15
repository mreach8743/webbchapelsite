import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Layout from './components/Layout';
import HomePage from './pages/HomePage';
import SubscribePage from './pages/SubscribePage';
import MinistriesPage from './pages/MinistriesPage';
import MissionariesPage from './pages/MissionariesPage';
import ContactPage from './pages/ContactPage';
import GivingPage from './pages/GivingPage';
import ImNewHerePage from './pages/ImNewHerePage';
import SmallGroupsPage from './pages/SmallGroupsPage';

function App() {
  return (
    <Router>
      <Layout>
        <Routes>
          <Route path="/" element={<HomePage />} />
          <Route path="/subscribe" element={<SubscribePage />} />
          <Route path="/ministries" element={<MinistriesPage />} />
          <Route path="/missionaries" element={<MissionariesPage />} />
          <Route path="/contact" element={<ContactPage />} />
          <Route path="/giving" element={<GivingPage />} />
          <Route path="/imnewhere" element={<ImNewHerePage />} />
          <Route path="/smallgroups" element={<SmallGroupsPage />} />
          {/* Add more routes as we create more pages */}
        </Routes>
      </Layout>
    </Router>
  );
}

export default App;