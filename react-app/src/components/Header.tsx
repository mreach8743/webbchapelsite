import { Link } from 'react-router-dom';
import { ChevronDown, Menu, X } from 'lucide-react';
import { useState } from 'react';

function Header() {
  const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);
  return (
    <>
      {/* Main Header */}
      <header className="bg-white shadow-md h-32 flex items-center header-background">
        <div className="container mx-auto px-4">
          <div className="flex items-center justify-between">
            {/* Mobile Menu Button - Left side */}
            <button 
              className="md:hidden p-2"
              onClick={() => setIsMobileMenuOpen(!isMobileMenuOpen)}
            >
              {isMobileMenuOpen ? <X className="h-6 w-6" /> : <Menu className="h-6 w-6" />}
            </button>

            {/* Desktop Left Navigation */}
            <nav className="hidden md:flex items-center space-x-6">
              <Link 
                to="/" 
                className="text-gray-800 hover:text-church-blue font-semibold transition-colors"
              >
                HOME
              </Link>
              
              {/* Leadership Dropdown */}
              <div className="relative group">
                <button className="flex items-center text-gray-800 hover:text-church-blue font-semibold transition-colors">
                  LEADERSHIP
                  <ChevronDown className="ml-1 h-4 w-4" />
                </button>
                <div className="absolute top-full left-0 mt-1 w-48 bg-white shadow-lg rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                  <Link 
                    to="/elders" 
                    className="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition-colors"
                  >
                    SHEPHERDS
                  </Link>
                  <Link 
                    to="/deacons" 
                    className="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition-colors"
                  >
                    DEACONS
                  </Link>
                  <Link 
                    to="/ministers" 
                    className="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition-colors"
                  >
                    MINISTERS
                  </Link>
                  <Link 
                    to="/staff" 
                    className="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition-colors"
                  >
                    STAFF
                  </Link>
                </div>
              </div>

              <Link 
                to="/livestreaming" 
                className="text-gray-800 hover:text-church-blue font-semibold transition-colors"
              >
                LIVESTREAM
              </Link>
            </nav>

            {/* Logo - Centered on mobile, normal position on desktop */}
            <div className="flex-shrink-0">
              <Link to="/">
                <img 
                  src="/src/assets/images/logo.png" 
                  alt="Webb Chapel church of Christ" 
                  className="h-20 w-auto"
                />
              </Link>
            </div>

            {/* Desktop Right Navigation */}
            <nav className="hidden md:flex items-center space-x-6">
              <Link 
                to="/smallgroups" 
                className="text-gray-800 hover:text-church-blue font-semibold transition-colors"
              >
                SMALL GROUPS
              </Link>
              
              {/* Members Dropdown */}
              <div className="relative group">
                <button className="flex items-center text-gray-800 hover:text-church-blue font-semibold transition-colors">
                  MEMBERS
                  <ChevronDown className="ml-1 h-4 w-4" />
                </button>
                <div className="absolute top-full left-0 mt-1 w-48 bg-white shadow-lg rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                  <Link 
                    to="/calendar" 
                    className="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition-colors"
                  >
                    CALENDAR
                  </Link>
                  <Link 
                    to="/giving" 
                    className="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition-colors"
                  >
                    GIVING
                  </Link>
                  <Link 
                    to="/summerlearningcamp" 
                    className="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition-colors"
                  >
                    SUMMER CAMP
                  </Link>
                  <a 
                    href="https://onrealm.org/WebbChapelChurch" 
                    target="_blank" 
                    rel="noopener noreferrer"
                    className="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition-colors"
                  >
                    REALM LOGIN
                  </a>
                </div>
              </div>

              <Link 
                to="/contact" 
                className="text-gray-800 hover:text-church-blue font-semibold transition-colors"
              >
                CONTACT
              </Link>
            </nav>

            {/* Spacer for mobile to balance the hamburger button */}
            <div className="md:hidden w-10"></div>
          </div>
        </div>
      </header>

      {/* Mobile Menu */}
      {isMobileMenuOpen && (
        <div className="md:hidden bg-white shadow-lg border-t">
          <div className="container mx-auto px-4 py-4">
            <nav className="space-y-4">
              <Link 
                to="/" 
                className="block text-gray-800 hover:text-church-blue font-semibold transition-colors py-2"
                onClick={() => setIsMobileMenuOpen(false)}
              >
                HOME
              </Link>
              
              <div className="space-y-2">
                <div className="text-gray-800 font-semibold py-2">LEADERSHIP</div>
                <div className="pl-4 space-y-2">
                  <Link 
                    to="/elders" 
                    className="block text-gray-600 hover:text-church-blue transition-colors py-1"
                    onClick={() => setIsMobileMenuOpen(false)}
                  >
                    SHEPHERDS
                  </Link>
                  <Link 
                    to="/deacons" 
                    className="block text-gray-600 hover:text-church-blue transition-colors py-1"
                    onClick={() => setIsMobileMenuOpen(false)}
                  >
                    DEACONS
                  </Link>
                  <Link 
                    to="/ministers" 
                    className="block text-gray-600 hover:text-church-blue transition-colors py-1"
                    onClick={() => setIsMobileMenuOpen(false)}
                  >
                    MINISTERS
                  </Link>
                  <Link 
                    to="/staff" 
                    className="block text-gray-600 hover:text-church-blue transition-colors py-1"
                    onClick={() => setIsMobileMenuOpen(false)}
                  >
                    STAFF
                  </Link>
                </div>
              </div>

              <Link 
                to="/livestreaming" 
                className="block text-gray-800 hover:text-church-blue font-semibold transition-colors py-2"
                onClick={() => setIsMobileMenuOpen(false)}
              >
                LIVESTREAM
              </Link>
              
              <Link 
                to="/smallgroups" 
                className="block text-gray-800 hover:text-church-blue font-semibold transition-colors py-2"
                onClick={() => setIsMobileMenuOpen(false)}
              >
                SMALL GROUPS
              </Link>
              
              <div className="space-y-2">
                <div className="text-gray-800 font-semibold py-2">MEMBERS</div>
                <div className="pl-4 space-y-2">
                  <Link 
                    to="/calendar" 
                    className="block text-gray-600 hover:text-church-blue transition-colors py-1"
                    onClick={() => setIsMobileMenuOpen(false)}
                  >
                    CALENDAR
                  </Link>
                  <Link 
                    to="/giving" 
                    className="block text-gray-600 hover:text-church-blue transition-colors py-1"
                    onClick={() => setIsMobileMenuOpen(false)}
                  >
                    GIVING
                  </Link>
                  <Link 
                    to="/summerlearningcamp" 
                    className="block text-gray-600 hover:text-church-blue transition-colors py-1"
                    onClick={() => setIsMobileMenuOpen(false)}
                  >
                    SUMMER CAMP
                  </Link>
                  <a 
                    href="https://onrealm.org/WebbChapelChurch" 
                    target="_blank" 
                    rel="noopener noreferrer"
                    className="block text-gray-600 hover:text-church-blue transition-colors py-1"
                    onClick={() => setIsMobileMenuOpen(false)}
                  >
                    REALM LOGIN
                  </a>
                </div>
              </div>

              <Link 
                to="/contact" 
                className="block text-gray-800 hover:text-church-blue font-semibold transition-colors py-2"
                onClick={() => setIsMobileMenuOpen(false)}
              >
                CONTACT
              </Link>
            </nav>
          </div>
        </div>
      )}

      {/* Contact Bar */}
      <div className="w-full text-center church-blue-background text-white font-bold py-2">
        13425 Webb Chapel Road, Farmers Branch, Texas 75234&nbsp;&nbsp;|&nbsp;&nbsp;(972) 241-3293
      </div>
    </>
  );
};

export default Header;
