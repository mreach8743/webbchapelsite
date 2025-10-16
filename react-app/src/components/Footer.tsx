import { Link } from 'react-router-dom';
import { Home, Phone, Mail, Facebook, Twitter } from 'lucide-react';

function Footer() {
  return (
    <>
      {/* Main Footer */}
      <footer className="bg-gray-800 text-white py-12">
        <div className="container mx-auto px-4">
          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            {/* Daily Encouragement */}
            <div>
              <h3 className="text-xl font-bold mb-4">DAILY ENCOURAGEMENT</h3>
              <div className="bg-white rounded-lg p-4">
                <a 
                  href="https://biblia.com/bible/kjv/verseoftheday" 
                  target="_blank" 
                  rel="noopener noreferrer"
                  className="block"
                >
                  <img 
                    src="https://biblia.com/api/plugins/verseoftheday/kjv?width=300&height=250&singleImage=true&theme=imagebased&variant=light" 
                    alt="Daily Bible Verse" 
                    className="w-full h-auto rounded"
                  />
                </a>
              </div>
            </div>

            {/* When We Meet */}
            <div>
              <h3 className="text-xl font-bold mb-4">WHEN WE MEET</h3>
              <div className="space-y-2">
                <div>
                  <strong className="underline">SUNDAY MORNING</strong><br />
                  <span className="ml-4">9:30 am Worship</span><br />
                  <span className="ml-4">11:00 am Classes for all ages</span>
                </div>
                <br />
                <div>
                  <strong className="underline">SUNDAY EVENING</strong><br />
                  <span className="ml-4">Small Group Meetings</span><br />
                  <span className="ml-4">Contact church office</span>
                </div>
              </div>
            </div>

            {/* Where We Meet */}
            <div>
              <h3 className="text-xl font-bold mb-4">WHERE WE MEET</h3>
              <div className="space-y-3">
                <div className="flex items-start">
                  <Home className="h-5 w-5 mt-1 mr-3 flex-shrink-0" />
                  <div>
                    <p>Webb Chapel church of Christ</p>
                    <p>13425 Webb Chapel Road,</p>
                    <p>Farmers Branch, Texas 75234</p>
                  </div>
                </div>
                <div className="flex items-center">
                  <Phone className="h-5 w-5 mr-3 flex-shrink-0" />
                  <p>(972) 241-3293</p>
                </div>
                <div className="flex items-center">
                  <Mail className="h-5 w-5 mr-3 flex-shrink-0" />
                  <Link 
                    to="/contact" 
                    className="underline hover:text-gray-300 transition-colors"
                  >
                    Email Us
                  </Link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </footer>

      {/* Copyright Footer */}
      <div className="bg-gray-900 text-white py-6">
        <div className="container mx-auto px-4">
          <div className="flex flex-col md:flex-row justify-between items-center">
            <div className="mb-4 md:mb-0">
              © Overseen by the Webb Chapel church of Christ Eldership
            </div>
            <div className="flex space-x-4">
              <a 
                href="https://www.facebook.com/WebbChapelUpdates" 
                target="_blank" 
                rel="noopener noreferrer"
                className="hover:text-gray-300 transition-colors"
              >
                <Facebook className="h-6 w-6" />
              </a>
              <a 
                href="https://twitter.com/webbchapel" 
                target="_blank" 
                rel="noopener noreferrer"
                className="hover:text-gray-300 transition-colors"
              >
                <Twitter className="h-6 w-6" />
              </a>
            </div>
          </div>
        </div>
      </div>

      {/* Back to Top Button */}
      <button 
        className="fixed bottom-6 right-6 bg-church-blue text-white p-3 rounded-full shadow-lg hover:bg-blue-800 transition-colors z-50"
        onClick={() => window.scrollTo({ top: 0, behavior: 'smooth' })}
      >
        ↑
      </button>
    </>
  );
};

export default Footer;
