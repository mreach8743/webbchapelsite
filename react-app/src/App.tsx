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
import LiveStreamingPage from './pages/LiveStreamingPage';
import SitbPage from './pages/SitbPage';
import SummerLearningCampPage from './pages/SummerLearningCampPage';
import EldersPage from './pages/EldersPage';
import DeaconsPage from './pages/DeaconsPage';
import MinistersPage from './pages/MinistersPage';
import StaffPage from './pages/StaffPage';
import CalendarPage from './pages/CalendarPage';

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
          <Route path="/livestreaming" element={<LiveStreamingPage />} />
          <Route path="/sitb" element={<SitbPage />} />
          <Route path="/summerlearningcamp" element={<SummerLearningCampPage />} />
          <Route path="/elders" element={<EldersPage />} />
          <Route path="/deacons" element={<DeaconsPage />} />
          <Route path="/ministers" element={<MinistersPage />} />
          <Route path="/staff" element={<StaffPage />} />
          <Route path="/calendar" element={<CalendarPage />} />
          {/* Add more routes as we create more pages */}
        </Routes>
      </Layout>
    </Router>
  );
}

export default App;