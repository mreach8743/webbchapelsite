import React from 'react';
import { Calendar, Clock, MapPin, ExternalLink } from 'lucide-react';

const CalendarPage: React.FC = () => {
  const upcomingEvents = [
    {
      title: "Sunday Worship Service",
      date: "Every Sunday",
      time: "10:30 AM",
      location: "Main Sanctuary",
      description: "Join us for our weekly worship service with preaching, singing, and fellowship."
    },
    {
      title: "Bible Study",
      date: "Every Sunday",
      time: "9:30 AM",
      location: "Various Rooms",
      description: "Adult Bible study classes for all ages and levels."
    },
    {
      title: "Wednesday Bible Study",
      date: "Every Wednesday",
      time: "7:00 PM",
      location: "Main Sanctuary",
      description: "Mid-week Bible study and prayer meeting."
    },
    {
      title: "Small Groups",
      date: "Various Days",
      time: "Various Times",
      location: "Homes & Church",
      description: "Small group Bible studies and fellowship meetings."
    }
  ];

  return (
    <div className="w-full">
      {/* Hero Section */}
      <div className="bg-gradient-to-r from-church-blue to-blue-800 text-white py-16">
        <div className="container mx-auto px-4">
          <div className="text-center">
            <h1 className="text-4xl md:text-5xl font-bold mb-4">
              Event Calendar
            </h1>
            <p className="text-xl md:text-2xl text-blue-100">
              Stay connected with all our church activities and events
            </p>
          </div>
        </div>
      </div>

      <div className="container mx-auto px-4 py-12">
        {/* Calendar Embed */}
        <div className="mb-12">
          <div className="bg-white rounded-lg shadow-lg overflow-hidden">
            <div className="bg-gray-50 px-6 py-4 border-b">
              <h2 className="text-2xl font-bold text-gray-800 flex items-center">
                <Calendar className="w-6 h-6 mr-3" />
                Church Calendar
              </h2>
              <p className="text-gray-600 mt-2">
                View all upcoming events and activities
              </p>
            </div>
            
            <div className="p-6">
              {/* Calendar Embed */}
              <div className="w-full min-h-[600px] bg-gray-100 rounded-lg flex items-center justify-center">
                <div className="text-center">
                  <Calendar className="w-16 h-16 text-gray-400 mx-auto mb-4" />
                  <h3 className="text-xl font-bold text-gray-600 mb-2">
                    Interactive Calendar
                  </h3>
                  <p className="text-gray-500 mb-4">
                    The full interactive calendar will be embedded here
                  </p>
                  <a 
                    href="https://www.webbchapel.org/calendar32/" 
                    target="_blank" 
                    rel="noopener noreferrer"
                    className="inline-flex items-center bg-church-blue text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors"
                  >
                    <ExternalLink className="w-4 h-4 mr-2" />
                    View Full Calendar
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        {/* Regular Events */}
        <div className="mb-12">
          <div className="bg-white rounded-lg shadow-lg p-8">
            <h2 className="text-2xl font-bold text-gray-800 mb-6 text-center">
              Regular Weekly Events
            </h2>
            
            <div className="grid md:grid-cols-2 gap-6">
              {upcomingEvents.map((event, index) => (
                <div key={index} className="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                  <div className="flex items-start space-x-4">
                    <div className="flex-shrink-0">
                      <div className="w-12 h-12 bg-church-blue rounded-lg flex items-center justify-center">
                        <Calendar className="w-6 h-6 text-white" />
                      </div>
                    </div>
                    <div className="flex-1">
                      <h3 className="text-lg font-bold text-gray-800 mb-2">
                        {event.title}
                      </h3>
                      <div className="space-y-1 text-sm text-gray-600">
                        <div className="flex items-center">
                          <Calendar className="w-4 h-4 mr-2" />
                          {event.date}
                        </div>
                        <div className="flex items-center">
                          <Clock className="w-4 h-4 mr-2" />
                          {event.time}
                        </div>
                        <div className="flex items-center">
                          <MapPin className="w-4 h-4 mr-2" />
                          {event.location}
                        </div>
                      </div>
                      <p className="text-gray-600 mt-3">
                        {event.description}
                      </p>
                    </div>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </div>

        {/* Special Events */}
        <div className="bg-gradient-to-r from-church-blue to-blue-800 text-white rounded-lg p-8 mb-12">
          <h2 className="text-3xl font-bold text-center mb-8">
            Special Events
          </h2>
          
          <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div className="text-center">
              <Calendar className="w-12 h-12 mx-auto mb-4" />
              <h3 className="text-xl font-bold mb-3">Holiday Services</h3>
              <p className="text-blue-100">
                Special worship services for Christmas, Easter, and other holidays
              </p>
            </div>
            
            <div className="text-center">
              <Calendar className="w-12 h-12 mx-auto mb-4" />
              <h3 className="text-xl font-bold mb-3">Community Events</h3>
              <p className="text-blue-100">
                Outreach events, community service projects, and fellowship activities
              </p>
            </div>
            
            <div className="text-center">
              <Calendar className="w-12 h-12 mx-auto mb-4" />
              <h3 className="text-xl font-bold mb-3">Educational Programs</h3>
              <p className="text-blue-100">
                Bible studies, seminars, and educational workshops for all ages
              </p>
            </div>
          </div>
        </div>

        {/* Calendar Admin */}
        <div className="bg-white rounded-lg shadow-lg p-8">
          <h2 className="text-2xl font-bold text-gray-800 mb-6 text-center">
            Calendar Administration
          </h2>
          <div className="text-center">
            <p className="text-gray-600 mb-6">
              For church leaders and staff who need to add or modify events on the calendar.
            </p>
            <a 
              href="https://www.webbchapel.org/calendar32/" 
              target="_blank" 
              rel="noopener noreferrer"
              className="inline-flex items-center bg-gray-200 text-gray-800 px-8 py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors"
            >
              <ExternalLink className="w-4 h-4 mr-2" />
              Calendar Admin Login
            </a>
          </div>
        </div>
      </div>
    </div>
  );
};

export default CalendarPage;
