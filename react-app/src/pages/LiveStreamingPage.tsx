import React from 'react';
import { Play, Archive, Calendar, Clock } from 'lucide-react';

const LiveStreamingPage: React.FC = () => {
  return (
    <div className="w-full">
      {/* Hero Section */}
      <div className="bg-gradient-to-r from-church-blue to-blue-800 text-white py-16">
        <div className="container mx-auto px-4">
          <div className="text-center">
            <h1 className="text-4xl md:text-5xl font-bold mb-4">
              Live Streaming Sunday Worship
            </h1>
            <p className="text-xl md:text-2xl text-blue-100">
              Join us for worship from anywhere
            </p>
          </div>
        </div>
      </div>

      <div className="container mx-auto px-4 py-12">
        {/* Live Stream Section */}
        <div className="mb-12">
          <div className="bg-white rounded-lg shadow-lg overflow-hidden">
            <div className="bg-red-600 text-white px-6 py-3 flex items-center">
              <div className="w-3 h-3 bg-white rounded-full mr-3 animate-pulse"></div>
              <span className="font-semibold">LIVE NOW</span>
            </div>
            
            <div className="p-6">
              <h2 className="text-2xl font-bold text-gray-800 mb-4">
                Sunday Worship Service
              </h2>
              
              {/* Live Stream Embed */}
              <div className="relative w-full" style={{ paddingBottom: '56.25%' }}>
                <iframe
                  src="https://www.youtube.com/embed/live_stream?channel=UC-ndzr4_oUM97yv5K_-B4vQ"
                  className="absolute top-0 left-0 w-full h-full rounded-lg"
                  frameBorder="0"
                  allowFullScreen
                  title="Webb Chapel Livestream"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                />
              </div>
              
              <div className="mt-6 flex flex-wrap gap-4 text-sm text-gray-600">
                <div className="flex items-center">
                  <Clock className="w-4 h-4 mr-2" />
                  Sundays at 10:30 AM
                </div>
                <div className="flex items-center">
                  <Calendar className="w-4 h-4 mr-2" />
                  Weekly Service
                </div>
              </div>
            </div>
          </div>
        </div>

        {/* Sermon Archives Section */}
        <div className="space-y-8">
          {/* 2025 Archives */}
          <div className="bg-white rounded-lg shadow-lg overflow-hidden">
            <div className="bg-gray-50 px-6 py-4 border-b">
              <h2 className="text-2xl font-bold text-gray-800 flex items-center">
                <Archive className="w-6 h-6 mr-3" />
                Sermon Archives 2025
              </h2>
              <p className="text-gray-600 mt-2">
                Recent sermons and teachings from 2025
              </p>
            </div>
            
            <div className="p-6">
              <div className="relative w-full" style={{ paddingBottom: '56.25%' }}>
                <iframe
                  src="https://www.youtube.com/embed/videoseries?list=PLom-0r33d-gAOWuczIHZAvbC_9eImSocp"
                  className="absolute top-0 left-0 w-full h-full rounded-lg"
                  frameBorder="0"
                  allowFullScreen
                  title="YouTube channel videos 2025"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                />
              </div>
            </div>
          </div>

          {/* 2024 Archives */}
          <div className="bg-white rounded-lg shadow-lg overflow-hidden">
            <div className="bg-gray-50 px-6 py-4 border-b">
              <h2 className="text-2xl font-bold text-gray-800 flex items-center">
                <Archive className="w-6 h-6 mr-3" />
                Sermon Archives 2024
              </h2>
              <p className="text-gray-600 mt-2">
                Sermons and teachings from 2024
              </p>
            </div>
            
            <div className="p-6">
              <div className="relative w-full" style={{ paddingBottom: '56.25%' }}>
                <iframe
                  src="https://www.youtube.com/embed/videoseries?list=PLom-0r33d-gCan9qQJRoJMLTce2Nq0u4L"
                  className="absolute top-0 left-0 w-full h-full rounded-lg"
                  frameBorder="0"
                  allowFullScreen
                  title="YouTube channel videos 2024"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                />
              </div>
            </div>
          </div>
        </div>

        {/* Additional Information */}
        <div className="mt-12 grid md:grid-cols-2 gap-8">
          <div className="bg-white rounded-lg shadow-lg p-6">
            <h3 className="text-xl font-bold text-gray-800 mb-4">
              How to Watch
            </h3>
            <ul className="space-y-3 text-gray-600">
              <li className="flex items-start">
                <Play className="w-5 h-5 mr-2 mt-0.5 text-church-blue" />
                <span>Click play on the live stream above</span>
              </li>
              <li className="flex items-start">
                <Play className="w-5 h-5 mr-2 mt-0.5 text-church-blue" />
                <span>Stream works on all devices</span>
              </li>
              <li className="flex items-start">
                <Play className="w-5 h-5 mr-2 mt-0.5 text-church-blue" />
                <span>No registration required</span>
              </li>
            </ul>
          </div>

          <div className="bg-white rounded-lg shadow-lg p-6">
            <h3 className="text-xl font-bold text-gray-800 mb-4">
              Service Times
            </h3>
            <div className="space-y-3">
              <div className="flex justify-between items-center py-2 border-b border-gray-100">
                <span className="font-medium">Sunday Worship</span>
                <span className="text-church-blue font-semibold">10:30 AM</span>
              </div>
              <div className="flex justify-between items-center py-2 border-b border-gray-100">
                <span className="font-medium">Sunday Bible Study</span>
                <span className="text-church-blue font-semibold">9:30 AM</span>
              </div>
              <div className="flex justify-between items-center py-2 border-b border-gray-100">
                <span className="font-medium">Wednesday Bible Study</span>
                <span className="text-church-blue font-semibold">7:00 PM</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default LiveStreamingPage;
